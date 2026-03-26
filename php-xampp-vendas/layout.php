<?php
/**
 * Template HTML reutilizavel - cabecalho, navegacao e rodape.
 */
require_once __DIR__ . '/config.php';

function renderHead(string $titulo): void
{
    if (!headers_sent()) {
        header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
        header('Pragma: no-cache');
        header('Expires: 0');
    }

    echo '<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
  <title>' . htmlspecialchars($titulo) . ' - Fatec Jales</title>
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>' . "\n";
}

function renderNav(string $recursoAtivo = ''): void
{
    $grupos = [
        'Dashboard' => [
            'dashboard' => ['label' => 'Inicio', 'icon' => 'layout-dashboard'],
        ],
        'Tabelas Base' => [
            'sexos'   => ['label' => 'Sexos', 'icon' => 'users'],
            'ruas'    => ['label' => 'Ruas', 'icon' => 'map-pin'],
            'bairros' => ['label' => 'Bairros', 'icon' => 'map'],
            'ufs'     => ['label' => 'UFs', 'icon' => 'globe'],
            'cidades' => ['label' => 'Cidades', 'icon' => 'landmark'],
            'ceps'    => ['label' => 'CEPs', 'icon' => 'mail'],
        ],
        'Operacional' => [
            'tipos'        => ['label' => 'Tipos', 'icon' => 'tag'],
            'marcas'       => ['label' => 'Marcas', 'icon' => 'award'],
            'fornecedores' => ['label' => 'Fornecedores', 'icon' => 'truck'],
            'produtos'     => ['label' => 'Produtos', 'icon' => 'package'],
        ],
        'Vendas' => [
            'clientes'        => ['label' => 'Clientes', 'icon' => 'user-check'],
            'compras'         => ['label' => 'Compras', 'icon' => 'shopping-cart'],
            'compra-produtos' => ['label' => 'Itens', 'icon' => 'list-plus'],
        ],
    ];

    echo '<aside class="sidebar">
  <div class="sidebar-logo">
    <i data-lucide="shopping-bag" class="text-primary"></i>
    <span>Fatec Vendas</span>
  </div>';

    foreach ($grupos as $grupoLabel => $itens) {
        echo '  <div class="nav-group-label">' . htmlspecialchars($grupoLabel) . '</div>' . "\n";

        foreach ($itens as $chave => $info) {
            $link = ($chave === 'dashboard') ? 'dashboard.php' : 'index.php?recurso=' . urlencode($chave);
            $isAtivo = ($chave === $recursoAtivo);
            $ativoClass = $isAtivo ? ' active' : '';

            echo '  <a href="' . htmlspecialchars($link, ENT_QUOTES, 'UTF-8') . '" class="nav-link-custom' . $ativoClass . '">
    <i data-lucide="' . htmlspecialchars($info['icon']) . '" size="18"></i>
    <span>' . htmlspecialchars($info['label']) . '</span>
  </a>' . "\n";
        }
    }

    echo '</aside>
<main class="main-content">' . "\n";
}

function renderFooter(): void
{
    echo '</main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    if (window.lucide && typeof window.lucide.createIcons === "function") {
      window.lucide.createIcons();
    }

    function hasSwal() {
      return typeof window.Swal !== "undefined" && typeof window.Swal.fire === "function";
    }

    window.showToastSuccess = function(title, text) {
      if (hasSwal()) {
        Swal.fire({
          title: title,
          text: text,
          icon: "success",
          background: "#1e1b4b",
          color: "#fff",
          timer: 2000,
          showConfirmButton: false
        });
        return;
      }
      alert(text);
    };

    window.showToastError = function(title, text) {
      if (hasSwal()) {
        Swal.fire({
          title: title,
          text: text,
          icon: "error",
          background: "#1e1b4b",
          color: "#fff",
          confirmButtonColor: "#ef4444"
        });
        return;
      }
      alert(text);
    };

    window.confirmDelete = function(url) {
      if (hasSwal()) {
        Swal.fire({
          title: "Tem certeza?",
          text: "Voce nao podera reverter isso!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#4f46e5",
          cancelButtonColor: "#ef4444",
          confirmButtonText: "Sim, remover!",
          cancelButtonText: "Cancelar",
          background: "#1e1b4b",
          color: "#fff"
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = url;
          }
        });
        return false;
      }

      if (window.confirm("Deseja remover este registro?")) {
        window.location.href = url;
      }
      return false;
    };
  </script>
</body>
</html>' . "\n";
}
