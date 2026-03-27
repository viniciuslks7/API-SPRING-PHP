<?php
require_once 'api_functions.php';
require_once 'config.php';
require_once 'layout.php';

$recurso = isset($_GET['recurso']) ? trim($_GET['recurso']) : null;
$entities = getEntitiesConfig();

if (!$recurso || !isset($entities[$recurso])) {
    header('Location: dashboard.php');
    exit;
}

$cfg = $entities[$recurso];

if (isset($_GET['delete'])) {
    $status = 0;
    $deleteOk = false;

    if ($cfg['is_composite']) {
        $codcompra = intval($_GET['codcompra'] ?? 0);
        $codproduto = intval($_GET['codproduto'] ?? 0);

        if ($codcompra > 0 && $codproduto > 0) {
            $resp = callAPIResponse('DELETE', API_BASE . '/' . $cfg['endpoint'] . '/' . $codcompra . '/' . $codproduto);
            $status = (int) ($resp['status'] ?? 0);
            $deleteOk = !empty($resp['ok']);
        }
    } else {
        $idDelete = intval($_GET['delete']);
        if ($idDelete > 0) {
            $resp = callAPIResponse('DELETE', API_BASE . '/' . $cfg['endpoint'] . '/' . $idDelete);
            $status = (int) ($resp['status'] ?? 0);
            $deleteOk = !empty($resp['ok']);
        }
    }

    if ($deleteOk) {
        header('Location: index.php?recurso=' . urlencode($recurso) . '&deleted=1&t=' . time());
    } else {
        header('Location: index.php?recurso=' . urlencode($recurso) . '&delete_error=1&status=' . $status . '&t=' . time());
    }
    exit;
}

$registros = callAPI('GET', API_BASE . '/' . $cfg['endpoint']);

renderHead($cfg['label_plural']);
renderNav($recurso);
?>

<div class="glass-card">
    <div class="glass-card-header">
        <div>
            <h2 class="mb-1"><?= htmlspecialchars($cfg['label_plural']) ?></h2>
            <p class="text-muted small mb-0">Gerenciamento de registros da tabela de <?= htmlspecialchars(strtolower($cfg['label_plural'])) ?></p>
        </div>
        <a href="<?= htmlspecialchars('cadastro.php?recurso=' . urlencode($recurso)) ?>"
           class="btn btn-premium btn-add d-flex align-items-center gap-2">
           <i data-lucide="plus" size="18"></i> Novo Registro
        </a>
    </div>

    <div class="p-0">
        <?php if (empty($registros)): ?>
            <div class="text-center py-5">
                <i data-lucide="search-x" size="48" class="text-muted mb-3"></i>
                <p class="text-muted mb-0">Nenhum registro encontrado.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="custom-table table-borderless">
                    <thead>
                        <tr>
                            <?php foreach ($cfg['columns'] as $col): ?>
                                <th><?= htmlspecialchars($col['label']) ?></th>
                            <?php endforeach; ?>
                            <th class="text-end">Acoes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($registros as $reg): ?>
                            <tr>
                                <?php foreach ($cfg['columns'] as $col): ?>
                                    <td>
                                        <?php
                                            $val = '-';

                                            if (isset($col['subfield'])) {
                                                if ($col['field'] === 'id') {
                                                    $val = $reg['id'][$col['subfield']] ?? '-';
                                                } else {
                                                    $val = $reg[$col['field']][$col['subfield']] ?? '-';
                                                }
                                            } else {
                                                $val = $reg[$col['field']] ?? '-';
                                            }

                                            if (is_array($val)) {
                                                $val = json_encode($val, JSON_UNESCAPED_UNICODE);
                                            }

                                            $labelNormalizado = strtolower((string) ($col['label'] ?? ''));
                                            $isCampoMoeda = (strpos($labelNormalizado, 'valor') !== false || strpos($labelNormalizado, 'preco') !== false);
                                            if ($isCampoMoeda && is_numeric($val)) {
                                                $val = 'R$ ' . number_format((float) $val, 2, ',', '.');
                                            }

                                            echo htmlspecialchars((string) $val);
                                        ?>
                                    </td>
                                <?php endforeach; ?>

                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <?php if ($cfg['is_composite']): ?>
                                            <?php
                                                $cck = intval($reg['id']['codcomprafk'] ?? 0);
                                                $cpk = intval($reg['id']['codprodutofk'] ?? 0);
                                                $editUrl = 'cadastro.php?recurso=' . urlencode($recurso) . '&codcompra=' . $cck . '&codproduto=' . $cpk;
                                                $deleteUrl = 'index.php?recurso=' . urlencode($recurso) . '&delete=1&codcompra=' . $cck . '&codproduto=' . $cpk;
                                            ?>
                                            <a href="<?= htmlspecialchars($editUrl, ENT_QUOTES, 'UTF-8') ?>" class="btn btn-sm btn-outline-warning border-0 p-2" title="Editar">
                                                <i data-lucide="edit-3" size="18"></i>
                                            </a>
                                            <a href="#" onclick="return confirmDelete('<?= htmlspecialchars($deleteUrl, ENT_QUOTES, 'UTF-8') ?>');" class="btn btn-sm btn-outline-danger border-0 p-2" title="Remover">
                                                <i data-lucide="trash-2" size="18"></i>
                                            </a>
                                        <?php else: ?>
                                            <?php $idAtual = $reg[$cfg['id_field']] ?? null; ?>
                                            <?php if ($idAtual !== null): ?>
                                                <?php
                                                    $editUrl = 'cadastro.php?recurso=' . urlencode($recurso) . '&id=' . urlencode((string) $idAtual);
                                                    $deleteUrl = 'index.php?recurso=' . urlencode($recurso) . '&delete=' . urlencode((string) $idAtual);
                                                ?>
                                                <a href="<?= htmlspecialchars($editUrl, ENT_QUOTES, 'UTF-8') ?>" class="btn btn-sm btn-outline-warning border-0 p-2" title="Editar">
                                                    <i data-lucide="edit-3" size="18"></i>
                                                </a>
                                                <a href="#" onclick="return confirmDelete('<?= htmlspecialchars($deleteUrl, ENT_QUOTES, 'UTF-8') ?>');" class="btn btn-sm btn-outline-danger border-0 p-2" title="Remover">
                                                    <i data-lucide="trash-2" size="18"></i>
                                                </a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php if (isset($_GET['deleted'])): ?>
<script>
window.addEventListener('load', function () {
    if (window.showToastSuccess) {
        window.showToastSuccess('Removido!', 'O registro foi excluido com sucesso.');
    }
});
</script>
<?php endif; ?>

<?php if (isset($_GET['saved'])): ?>
<script>
window.addEventListener('load', function () {
    if (window.showToastSuccess) {
        window.showToastSuccess('Salvo!', 'Os dados foram processados com sucesso.');
    }
});
</script>
<?php endif; ?>

<?php if (isset($_GET['delete_error'])): ?>
<script>
window.addEventListener('load', function () {
    const status = <?= intval($_GET['status'] ?? 0) ?>;
    let message = 'Nao foi possivel excluir o registro.';

    if (status === 409) {
        message = 'Registro em uso por outra tabela (relacionamento ativo).';
    }

    if (window.showToastError) {
        window.showToastError('Falha ao excluir', message);
    }
});
</script>
<?php endif; ?>

<?php renderFooter(); ?>
