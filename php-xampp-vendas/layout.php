<?php
/**
 * Template HTML reutilizável — cabeçalho, navegação Bootstrap e rodapé.
 * Elimina o boilerplate duplicado entre index.php e cadastro.php.
 */
require_once __DIR__ . '/config.php';

function renderHead(string $titulo): void
{
    echo '<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <title>' . htmlspecialchars($titulo) . ' - Fatec Jales</title>
</head>
<body class="bg-light">' . "\n";
}

function renderNav(string $recursoAtivo = ''): void
{
    $entities = getEntitiesConfig();
    $grupos   = [
        'Tabelas Base' => ['sexos', 'ruas', 'bairros', 'ufs', 'cidades', 'ceps'],
        'Produtos'     => ['tipos', 'marcas', 'fornecedores', 'produtos'],
        'Vendas'       => ['clientes', 'compras', 'compra-produtos'],
    ];

    echo '<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="index.php">&#128722; Fatec Jales 2026</a>
    <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Menu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">' . "\n";

    foreach ($grupos as $grupoLabel => $chaves) {
        echo '        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button"
             data-bs-toggle="dropdown" aria-expanded="false">'
            . htmlspecialchars($grupoLabel) . '</a>
          <ul class="dropdown-menu">' . "\n";

        foreach ($chaves as $chave) {
            if (!isset($entities[$chave])) {
                continue;
            }
            $cfg  = $entities[$chave];
            $ativo = ($chave === $recursoAtivo) ? ' active fw-bold' : '';
            echo '            <li><a class="dropdown-item' . $ativo . '" href="'
                . htmlspecialchars('index.php?recurso=' . urlencode($chave)) . '">'
                . htmlspecialchars($cfg['label_plural']) . "</a></li>\n";
        }

        echo "          </ul>\n        </li>\n";
    }

    echo '      </ul>
    </div>
  </div>
</nav>' . "\n";
}

function renderFooter(): void
{
    echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>' . "\n";
}
