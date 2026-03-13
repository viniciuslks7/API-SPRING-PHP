<?php
require_once 'api_functions.php';
require_once 'config.php';
require_once 'layout.php';

// ── Contexto: recurso e entidade ──────────────────────────────────────────────
$recurso  = isset($_GET['recurso']) ? trim($_GET['recurso']) : 'sexos';
$entities = getEntitiesConfig();
if (!isset($entities[$recurso])) {
    $recurso = 'sexos';
}
$cfg = $entities[$recurso];

// ── Determinar modo (novo ou edição) a partir dos parâmetros GET ──────────────
$isEditing  = false;
$id         = 0;
$codcompra  = 0;
$codproduto = 0;

if ($cfg['is_composite']) {
    $codcompra  = isset($_GET['codcompra'])  ? intval($_GET['codcompra'])  : 0;
    $codproduto = isset($_GET['codproduto']) ? intval($_GET['codproduto']) : 0;
    $isEditing  = ($codcompra > 0 && $codproduto > 0);
} else {
    $id        = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $isEditing = ($id > 0);
}

// ── Buscar registro existente (somente em GET, para preencher o form) ─────────
$dados = null;
if ($isEditing && $_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($cfg['is_composite']) {
        $dados = callAPI(
            'GET',
            API_BASE . '/' . $cfg['endpoint'] . '/' . $codcompra . '/' . $codproduto
        );
    } else {
        $dados = callAPI('GET', API_BASE . '/' . $cfg['endpoint'] . '/' . $id);
    }
    if (empty($dados)) {
        $dados = null;
    }
}

// ── Processar envio do formulário ─────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payload = [];

    foreach ($cfg['fields'] as $field) {
        $rawVal = $_POST[$field['name']] ?? '';

        switch ($field['type']) {
            case 'fk':
                $fkId = intval($rawVal);
                $payload[$field['name']] = [$field['fk_id'] => $fkId];
                break;
            case 'number':
                $payload[$field['name']] = intval($rawVal);
                break;
            case 'decimal':
                $payload[$field['name']] = floatval(str_replace(',', '.', $rawVal));
                break;
            default:
                $payload[$field['name']] = trim($rawVal);
        }
    }

    // Para compra-produtos: incluir o campo "id" composto derivado das FKs
    if ($cfg['is_composite']) {
        $cpComp = intval($payload['compra']['codcompra']   ?? 0);
        $cpProd = intval($payload['produto']['codproduto'] ?? 0);
        $payload['id'] = [
            'codcomprafk'  => $cpComp,
            'codprodutofk' => $cpProd,
        ];
    }

    $jsonPayload = json_encode($payload);

    if ($cfg['is_composite'] && $isEditing) {
        callAPI(
            'PUT',
            API_BASE . '/' . $cfg['endpoint'] . '/' . $codcompra . '/' . $codproduto,
            $jsonPayload
        );
    } elseif ($cfg['is_composite']) {
        callAPI('POST', API_BASE . '/' . $cfg['endpoint'], $jsonPayload);
    } elseif ($isEditing) {
        callAPI('PUT', API_BASE . '/' . $cfg['endpoint'] . '/' . $id, $jsonPayload);
    } else {
        callAPI('POST', API_BASE . '/' . $cfg['endpoint'], $jsonPayload);
    }

    header('Location: ' . 'index.php?recurso=' . urlencode($recurso));
    exit;
}

// ── Pré-carregar opções para os selects de FK ─────────────────────────────────
$fkOptions = [];
foreach ($cfg['fields'] as $field) {
    if ($field['type'] === 'fk') {
        $fkOptions[$field['name']] = callAPI('GET', API_BASE . '/' . $field['fk_endpoint']);
    }
}

// ── Renderizar página ─────────────────────────────────────────────────────────
$titulo = ($isEditing ? 'Editar ' : 'Novo ') . $cfg['label'];
renderHead($titulo);
renderNav($recurso);
?>
<div class="container pb-5">
  <div class="row justify-content-center">
    <div class="col-lg-7">
      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
          <h5 class="mb-0"><?= htmlspecialchars($titulo) ?></h5>
        </div>
        <div class="card-body">
          <form method="POST">

            <?php foreach ($cfg['fields'] as $field): ?>
              <div class="mb-3">
                <label class="form-label fw-semibold">
                  <?= htmlspecialchars($field['label']) ?>
                  <?php if (!empty($field['required'])): ?>
                    <span class="text-danger" title="Obrigatório">*</span>
                  <?php endif; ?>
                </label>

                <?php if ($field['type'] === 'fk'): ?>
                  <?php
                    // Valor atual para pré-selecionar
                    $currentFkId = null;
                    if ($dados !== null && isset($dados[$field['name']])) {
                        $currentFkId = $dados[$field['name']][$field['fk_id']] ?? null;
                    }
                  ?>
                  <select name="<?= htmlspecialchars($field['name']) ?>"
                          class="form-select"
                          <?= !empty($field['required']) ? 'required' : '' ?>>
                    <option value="">-- Selecione --</option>
                    <?php foreach (($fkOptions[$field['name']] ?? []) as $opt): ?>
                      <?php
                        $optId  = $opt[$field['fk_id']]     ?? '';
                        $optLbl = $opt[$field['fk_display']] ?? (string)$optId;
                      ?>
                      <option value="<?= htmlspecialchars((string)$optId) ?>"
                        <?= ($currentFkId !== null && (string)$currentFkId === (string)$optId)
                              ? 'selected' : '' ?>>
                        <?= htmlspecialchars('[' . $optId . '] ' . $optLbl) ?>
                      </option>
                    <?php endforeach; ?>
                  </select>

                <?php elseif ($field['type'] === 'date'): ?>
                  <input type="date"
                         name="<?= htmlspecialchars($field['name']) ?>"
                         class="form-control"
                         value="<?= htmlspecialchars((string)($dados[$field['name']] ?? '')) ?>"
                         <?= !empty($field['required']) ? 'required' : '' ?> />

                <?php elseif ($field['type'] === 'number'): ?>
                  <input type="number"
                         name="<?= htmlspecialchars($field['name']) ?>"
                         class="form-control"
                         value="<?= htmlspecialchars((string)($dados[$field['name']] ?? '')) ?>"
                         <?= isset($field['min'])         ? 'min="'         . htmlspecialchars((string)$field['min'])         . '"' : '' ?>
                         <?= isset($field['placeholder']) ? 'placeholder="' . htmlspecialchars($field['placeholder'])          . '"' : '' ?>
                         <?= !empty($field['required']) ? 'required' : '' ?> />

                <?php elseif ($field['type'] === 'decimal'): ?>
                  <input type="number"
                         name="<?= htmlspecialchars($field['name']) ?>"
                         class="form-control"
                         value="<?= htmlspecialchars((string)($dados[$field['name']] ?? '')) ?>"
                         step="<?= htmlspecialchars((string)($field['step'] ?? '0.01')) ?>"
                         <?= isset($field['min'])         ? 'min="'         . htmlspecialchars((string)$field['min'])         . '"' : '' ?>
                         <?= isset($field['placeholder']) ? 'placeholder="' . htmlspecialchars($field['placeholder'])          . '"' : '' ?>
                         <?= !empty($field['required']) ? 'required' : '' ?> />

                <?php elseif ($field['type'] === 'email'): ?>
                  <input type="email"
                         name="<?= htmlspecialchars($field['name']) ?>"
                         class="form-control"
                         value="<?= htmlspecialchars((string)($dados[$field['name']] ?? '')) ?>"
                         <?= isset($field['placeholder']) ? 'placeholder="' . htmlspecialchars($field['placeholder']) . '"' : '' ?>
                         <?= !empty($field['required']) ? 'required' : '' ?> />

                <?php else: /* text (padrão) */ ?>
                  <input type="text"
                         name="<?= htmlspecialchars($field['name']) ?>"
                         class="form-control"
                         value="<?= htmlspecialchars((string)($dados[$field['name']] ?? '')) ?>"
                         <?= isset($field['minlength'])   ? 'minlength="'   . intval($field['minlength'])                     . '"' : '' ?>
                         <?= isset($field['maxlength'])   ? 'maxlength="'   . intval($field['maxlength'])                     . '"' : '' ?>
                         <?= isset($field['pattern'])     ? 'pattern="'     . htmlspecialchars($field['pattern'])             . '"' : '' ?>
                         <?= isset($field['placeholder']) ? 'placeholder="' . htmlspecialchars($field['placeholder'])          . '"' : '' ?>
                         <?= !empty($field['required']) ? 'required' : '' ?> />
                <?php endif; ?>
              </div>
            <?php endforeach; ?>

            <hr />
            <div class="d-flex justify-content-between">
              <a href="<?= htmlspecialchars('index.php?recurso=' . urlencode($recurso)) ?>"
                 class="btn btn-secondary">&larr; Voltar</a>
              <button type="submit" class="btn btn-primary">
                <?= $isEditing ? 'Salvar Alterações' : 'Cadastrar' ?>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php renderFooter(); ?>