<?php
require_once 'api_functions.php';
require_once 'config.php';
require_once 'layout.php';

renderHead('Dashboard');
renderNav('dashboard');

// Buscar algumas estatísticas reais da API
$clientes = count(callAPI('GET', API_BASE . '/clientes'));
$produtos = count(callAPI('GET', API_BASE . '/produtos'));
$compras  = count(callAPI('GET', API_BASE . '/compras'));
$cidades  = count(callAPI('GET', API_BASE . '/cidades'));
?>

<div class="row g-4 mb-5">
    <div class="col-md-3">
        <div class="glass-card h-100 d-flex flex-column justify-content-center align-items-center text-center py-4">
            <div class="rounded-circle bg-primary bg-opacity-25 p-3 mb-3">
                <i data-lucide="users" class="text-primary" size="32"></i>
            </div>
            <h3 class="fw-bold mb-1"><?= $clientes ?></h3>
            <p class="text-muted small mb-0">Clientes Cadastrados</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="glass-card h-100 d-flex flex-column justify-content-center align-items-center text-center py-4">
            <div class="rounded-circle bg-success bg-opacity-25 p-3 mb-3">
                <i data-lucide="package" class="text-success" size="32"></i>
            </div>
            <h3 class="fw-bold mb-1"><?= $produtos ?></h3>
            <p class="text-muted small mb-0">Produtos em Catálogo</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="glass-card h-100 d-flex flex-column justify-content-center align-items-center text-center py-4">
            <div class="rounded-circle bg-info bg-opacity-25 p-3 mb-3">
                <i data-lucide="shopping-bag" class="text-info" size="32"></i>
            </div>
            <h3 class="fw-bold mb-1"><?= $compras ?></h3>
            <p class="text-muted small mb-0">Total de Compras</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="glass-card h-100 d-flex flex-column justify-content-center align-items-center text-center py-4">
            <div class="rounded-circle bg-warning bg-opacity-25 p-3 mb-3">
                <i data-lucide="map-pin" class="text-warning" size="32"></i>
            </div>
            <h3 class="fw-bold mb-1"><?= $cidades ?></h3>
            <p class="text-muted small mb-0">Cidades Atendidas</p>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="glass-card">
            <div class="glass-card-header">
                <h5 class="mb-0">Bem-vindo ao Sistema de Vendas Fatec</h5>
            </div>
            <div class="py-3">
                <p>Esta interface moderna foi construída para facilitar o gerenciamento de todas as entidades do seu banco de dados de vendas.</p>
                <p>Utilize a sidebar lateral para navegar entre os módulos:</p>
                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3 p-3 rounded-4 bg-white bg-opacity-5 border border-white border-opacity-10">
                            <i data-lucide="database" class="text-primary"></i>
                            <div>
                                <h6 class="mb-0">Tabelas Base</h6>
                                <small class="text-muted">Cadastro de Sexos, Ruas, Cidades...</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3 p-3 rounded-4 bg-white bg-opacity-5 border border-white border-opacity-10">
                            <i data-lucide="box" class="text-success"></i>
                            <div>
                                <h6 class="mb-0">Operacional</h6>
                                <small class="text-muted">Gestão de Marcas, Tipos e Produtos</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="glass-card h-100">
            <div class="glass-card-header">
                <h5 class="mb-0">Status da API</h5>
            </div>
            <div class="py-3 text-center">
                <div class="pulse-container mb-3">
                    <div class="pulse-blob bg-success"></div>
                </div>
                <h6 class="text-success fw-bold">Online</h6>
                <p class="text-muted small">Conectado em: <?= htmlspecialchars(API_BASE) ?></p>
                <hr class="border-secondary opacity-25">
                <small class="text-muted">Versão 2.1.0-Release</small>
            </div>
        </div>
    </div>
</div>

<style>
.pulse-blob {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    margin: 0 auto;
    box-shadow: 0 0 0 0 rgba(16, 185, 129, 1);
    animation: pulse-green 2s infinite;
}

@keyframes pulse-green {
    0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
    70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(16, 185, 129, 0); }
    100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
}
</style>

<?php renderFooter(); ?>
