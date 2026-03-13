<?php
require_once 'api_functions.php';
require_once 'config.php';
require_once 'layout.php';

// Recurso ativo (padrão: sexos)
$recurso  = isset($_GET['recurso']) ? trim($_GET['recurso']) : 'sexos';
$entities = getEntitiesConfig();
if (!isset($entities[$recurso])) {
    $recurso = 'sexos';
}
$cfg = $entities[$recurso];

// ── Exclusão ─────────────────────────────────────────────────────────────────
if (isset($_GET['delete'])) {
    if ($cfg['is_composite']) {
        $codcompra  = intval($_GET['codcompra']  ?? 0);
        $codproduto = intval($_GET['codproduto'] ?? 0);
        if ($codcompra > 0 && $codproduto > 0) {
            callAPI('DELETE', API_BASE . '/' . $cfg['endpoint'] . '/' . $codcompra . '/' . $codproduto);
        }
    } else {
        $idDelete = intval($_GET['delete']);
        if ($idDelete > 0) {
            callAPI('DELETE', API_BASE . '/' . $cfg['endpoint'] . '/' . $idDelete);
        }
    }
    header('Location: ' . 'index.php?recurso=' . urlencode($recurso));
    exit;
}

// ── Buscar registros ──────────────────────────────────────────────────────────
$registros = callAPI('GET', API_BASE . '/' . $cfg['endpoint']);

renderHead($cfg['label_plural']);
renderNav($recurso);
?>
<div class="container-fluid px-4 pb-5">
  <div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center bg-white py-3">
      <h5 class="mb-0"><?= htmlspecialchars($cfg['label_plural']) ?></h5>
      <a href="<?= htmlspecialchars('cadastro.php?recurso=' . urlencode($recurso)) ?>"
         class="btn btn-success btn-sm">+ Adicionar</a>
    </div>

    <div class="card-body p-0">
      <?php if (empty($registros)): ?>
        <p class="text-muted text-center py-4 mb-0">Nenhum registro encontrado.</p>
      <?php else: ?>
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
              <tr>
                <?php foreach ($cfg['columns'] as $col): ?>
                  <th><?= htmlspecialchars($col['label']) ?></th>
                <?php endforeach; ?>
                <th class="text-end">Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($registros as $reg): ?>
                <tr>
                  <?php foreach ($cfg['columns'] as $col): ?>
                    <td>
                      <?php
                        if (isset($col['subfield'])) {
                            $val = $reg[$col['field']][$col['subfield']] ?? '-';
                        } else {
                            $val = $reg[$col['field']] ?? '-';
                        }
                        if (is_array($val)) {
                            $val = json_encode($val);
                        }
                        echo htmlspecialchars((string) $val);
                      ?>
                    </td>
                  <?php endforeach; ?>

                  <td class="text-end text-nowrap">
                    <?php if ($cfg['is_composite']): ?>
                      <?php
                        $cck = intval($reg['id']['codcomprafk']  ?? 0);
                        $cpk = intval($reg['id']['codprodutofk'] ?? 0);
                        $editUrl   = 'cadastro.php?recurso=' . urlencode($recurso)
                                   . '&amp;codcompra='  . $cck
                                   . '&amp;codproduto=' . $cpk;
                        $deleteUrl = 'index.php?recurso=' . urlencode($recurso)
                                   . '&amp;delete=1'
                                   . '&amp;codcompra='  . $cck
                                   . '&amp;codproduto=' . $cpk;
                      ?>
                      <a href="<?= $editUrl ?>" class="btn btn-warning btn-sm">Editar</a>
                      <a href="<?= $deleteUrl ?>" class="btn btn-danger btn-sm"
                         onclick="return confirm('Excluir este item?');">Remover</a>

                    <?php else: ?>
                      <?php $idAtual = $reg[$cfg['id_field']] ?? null; ?>
                      <?php if ($idAtual !== null): ?>
                        <a href="<?= htmlspecialchars('cadastro.php?recurso=' . urlencode($recurso) . '&id=' . urlencode((string)$idAtual)) ?>"
                           class="btn btn-warning btn-sm">Editar</a>
                        <a href="<?= htmlspecialchars('index.php?recurso=' . urlencode($recurso) . '&delete=' . urlencode((string)$idAtual)) ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Excluir este registro?');">Remover</a>
                      <?php else: ?>
                        <span class="text-muted small">Sem ID</span>
                      <?php endif; ?>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php renderFooter(); ?>