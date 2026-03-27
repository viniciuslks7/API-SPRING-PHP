<?php
/**
 * Configuração centralizada de todas as 13 entidades da API de Vendas.
 *
 * Cada entidade define:
 *  - endpoint       : caminho na API (ex: "sexos")
 *  - id_field       : campo ID no JSON (ex: "codsexo"); null = composite key
 *  - is_composite   : true apenas para compra-produtos
 *  - label          : nome singular legível
 *  - label_plural   : nome plural legível
 *  - columns        : colunas da tabela de listagem
 *      - field      : chave no objeto JSON
 *      - subfield   : (opcional) chave dentro de objeto aninhado (FK)
 *      - label      : rótulo da coluna
 *  - fields         : campos do formulário de cadastro/edição
 *      - name       : chave do campo no POST e no payload JSON
 *      - label      : rótulo do campo
 *      - type       : 'text' | 'number' | 'decimal' | 'date' | 'email' | 'fk'
 *      - fk_endpoint: (type=fk) endpoint para buscar opções
 *      - fk_id      : (type=fk) campo ID no objeto de opção
 *      - fk_display : (type=fk) campo de exibição no objeto de opção
 *      - required   : bool
 *      - minlength  : (opcional)
 *      - maxlength  : (opcional)
 *      - placeholder: (opcional)
 *      - pattern    : (opcional) regex HTML5
 *      - min        : (opcional) valor mínimo numérico
 *      - step       : (opcional) incremento para decimais
 */
function getEntitiesConfig(): array
{
    return [

        /* ------------------------------------------------------------------ */
        /* TABELAS BASE                                                        */
        /* ------------------------------------------------------------------ */

        'sexos' => [
            'endpoint'     => 'sexos',
            'id_field'     => 'codsexo',
            'is_composite' => false,
            'label'        => 'Sexo',
            'label_plural' => 'Sexos',
            'columns' => [
                ['field' => 'codsexo',  'label' => 'ID'],
                ['field' => 'nomesexo', 'label' => 'Descrição'],
            ],
            'fields' => [
                ['name' => 'nomesexo', 'label' => 'Nome do Sexo', 'type' => 'text',
                 'placeholder' => 'Ex: MASCULINO', 'required' => true,
                 'minlength' => 3, 'maxlength' => 20],
            ],
        ],

        'ruas' => [
            'endpoint'     => 'ruas',
            'id_field'     => 'codrua',
            'is_composite' => false,
            'label'        => 'Rua',
            'label_plural' => 'Ruas',
            'columns' => [
                ['field' => 'codrua',  'label' => 'ID'],
                ['field' => 'nomerua', 'label' => 'Nome'],
            ],
            'fields' => [
                ['name' => 'nomerua', 'label' => 'Nome da Rua', 'type' => 'text',
                 'placeholder' => 'Ex: Rua das Flores', 'required' => true,
                 'minlength' => 3, 'maxlength' => 120],
            ],
        ],

        'bairros' => [
            'endpoint'     => 'bairros',
            'id_field'     => 'codbairro',
            'is_composite' => false,
            'label'        => 'Bairro',
            'label_plural' => 'Bairros',
            'columns' => [
                ['field' => 'codbairro',  'label' => 'ID'],
                ['field' => 'nomebairro', 'label' => 'Nome'],
            ],
            'fields' => [
                ['name' => 'nomebairro', 'label' => 'Nome do Bairro', 'type' => 'text',
                 'placeholder' => 'Ex: Centro', 'required' => true,
                 'minlength' => 2, 'maxlength' => 120],
            ],
        ],

        'ufs' => [
            'endpoint'     => 'ufs',
            'id_field'     => 'coduf',
            'is_composite' => false,
            'label'        => 'UF',
            'label_plural' => 'UFs',
            'columns' => [
                ['field' => 'coduf',   'label' => 'ID'],
                ['field' => 'nomeuf',  'label' => 'Nome'],
                ['field' => 'siglauf', 'label' => 'Sigla'],
            ],
            'fields' => [
                ['name' => 'nomeuf', 'label' => 'Nome do Estado', 'type' => 'text',
                 'placeholder' => 'Ex: São Paulo', 'required' => true,
                 'minlength' => 2, 'maxlength' => 60],
                ['name' => 'siglauf', 'label' => 'Sigla (2 letras)', 'type' => 'text',
                 'placeholder' => 'Ex: SP', 'required' => true,
                 'minlength' => 2, 'maxlength' => 2],
            ],
        ],

        'cidades' => [
            'endpoint'     => 'cidades',
            'id_field'     => 'codcidade',
            'is_composite' => false,
            'label'        => 'Cidade',
            'label_plural' => 'Cidades',
            'columns' => [
                ['field' => 'codcidade',  'label' => 'ID'],
                ['field' => 'nomecidade', 'label' => 'Nome'],
                ['field' => 'uf', 'subfield' => 'siglauf', 'label' => 'UF'],
            ],
            'fields' => [
                ['name' => 'nomecidade', 'label' => 'Nome da Cidade', 'type' => 'text',
                 'placeholder' => 'Ex: Jales', 'required' => true,
                 'minlength' => 2, 'maxlength' => 120],
                ['name' => 'uf', 'label' => 'Estado (UF)', 'type' => 'fk',
                 'fk_endpoint' => 'ufs', 'fk_id' => 'coduf', 'fk_display' => 'nomeuf',
                 'required' => true],
            ],
        ],

        'ceps' => [
            'endpoint'     => 'ceps',
            'id_field'     => 'codcep',
            'is_composite' => false,
            'label'        => 'CEP',
            'label_plural' => 'CEPs',
            'columns' => [
                ['field' => 'codcep',    'label' => 'ID'],
                ['field' => 'numerocep', 'label' => 'Número CEP'],
            ],
            'fields' => [
                ['name' => 'numerocep', 'label' => 'Número do CEP', 'type' => 'text',
                 'placeholder' => 'Ex: 15700-000', 'required' => true,
                 'pattern' => '^\d{5}-?\d{3}$', 'maxlength' => 9],
            ],
        ],

        /* ------------------------------------------------------------------ */
        /* PRODUTOS                                                            */
        /* ------------------------------------------------------------------ */

        'tipos' => [
            'endpoint'     => 'tipos',
            'id_field'     => 'codtipo',
            'is_composite' => false,
            'label'        => 'Tipo',
            'label_plural' => 'Tipos',
            'columns' => [
                ['field' => 'codtipo',  'label' => 'ID'],
                ['field' => 'nometipo', 'label' => 'Nome'],
            ],
            'fields' => [
                ['name' => 'nometipo', 'label' => 'Nome do Tipo', 'type' => 'text',
                 'placeholder' => 'Ex: Eletrônico', 'required' => true,
                 'minlength' => 2, 'maxlength' => 80],
            ],
        ],

        'marcas' => [
            'endpoint'     => 'marcas',
            'id_field'     => 'codmarca',
            'is_composite' => false,
            'label'        => 'Marca',
            'label_plural' => 'Marcas',
            'columns' => [
                ['field' => 'codmarca',  'label' => 'ID'],
                ['field' => 'nomemarca', 'label' => 'Nome'],
            ],
            'fields' => [
                ['name' => 'nomemarca', 'label' => 'Nome da Marca', 'type' => 'text',
                 'placeholder' => 'Ex: Samsung', 'required' => true,
                 'minlength' => 2, 'maxlength' => 80],
            ],
        ],

        'fornecedores' => [
            'endpoint'     => 'fornecedores',
            'id_field'     => 'codfornecedor',
            'is_composite' => false,
            'label'        => 'Fornecedor',
            'label_plural' => 'Fornecedores',
            'columns' => [
                ['field' => 'codfornecedor',     'label' => 'ID'],
                ['field' => 'nomefornecedor',    'label' => 'Nome'],
                ['field' => 'emailfornecedor',   'label' => 'E-mail'],
                ['field' => 'telefonefornecedor','label' => 'Telefone'],
            ],
            'fields' => [
                ['name' => 'nomefornecedor', 'label' => 'Nome do Fornecedor', 'type' => 'text',
                 'placeholder' => 'Ex: Tech Distribuidora', 'required' => true,
                 'minlength' => 3, 'maxlength' => 120],
                ['name' => 'rua', 'label' => 'Rua', 'type' => 'fk',
                 'fk_endpoint' => 'ruas', 'fk_id' => 'codrua', 'fk_display' => 'nomerua',
                 'required' => true],
                ['name' => 'bairro', 'label' => 'Bairro', 'type' => 'fk',
                 'fk_endpoint' => 'bairros', 'fk_id' => 'codbairro', 'fk_display' => 'nomebairro',
                 'required' => true],
                ['name' => 'cep', 'label' => 'CEP', 'type' => 'fk',
                 'fk_endpoint' => 'ceps', 'fk_id' => 'codcep', 'fk_display' => 'numerocep',
                 'required' => true],
                ['name' => 'cidade', 'label' => 'Cidade', 'type' => 'fk',
                 'fk_endpoint' => 'cidades', 'fk_id' => 'codcidade', 'fk_display' => 'nomecidade',
                 'required' => true],
                ['name' => 'telefonefornecedor', 'label' => 'Telefone', 'type' => 'text',
                 'placeholder' => 'Ex: (17) 99999-0000', 'required' => true,
                 'minlength' => 8, 'maxlength' => 20],
                ['name' => 'emailfornecedor', 'label' => 'E-mail', 'type' => 'email',
                 'placeholder' => 'Ex: contato@fornecedor.com.br', 'required' => true],
            ],
        ],

        'produtos' => [
            'endpoint'     => 'produtos',
            'id_field'     => 'codproduto',
            'is_composite' => false,
            'label'        => 'Produto',
            'label_plural' => 'Produtos',
            'columns' => [
                ['field' => 'codproduto',  'label' => 'ID'],
                ['field' => 'nomeproduto', 'label' => 'Nome'],
                ['field' => 'tipo',  'subfield' => 'nometipo',  'label' => 'Tipo'],
                ['field' => 'marca', 'subfield' => 'nomemarca', 'label' => 'Marca'],
                ['field' => 'quantidade', 'label' => 'Qtd'],
                ['field' => 'valor',      'label' => 'Valor (R$)'],
            ],
            'fields' => [
                ['name' => 'nomeproduto', 'label' => 'Nome do Produto', 'type' => 'text',
                 'placeholder' => 'Ex: Smartphone XZ', 'required' => true,
                 'minlength' => 2, 'maxlength' => 120],
                ['name' => 'tipo', 'label' => 'Tipo', 'type' => 'fk',
                 'fk_endpoint' => 'tipos', 'fk_id' => 'codtipo', 'fk_display' => 'nometipo',
                 'required' => true],
                ['name' => 'marca', 'label' => 'Marca', 'type' => 'fk',
                 'fk_endpoint' => 'marcas', 'fk_id' => 'codmarca', 'fk_display' => 'nomemarca',
                 'required' => true],
                ['name' => 'quantidade', 'label' => 'Quantidade em Estoque', 'type' => 'number',
                 'required' => true, 'min' => 0, 'placeholder' => 'Ex: 10'],
                ['name' => 'valor', 'label' => 'Valor (R$)', 'type' => 'decimal',
                 'required' => true, 'min' => '0.00', 'step' => '0.01',
                 'placeholder' => 'Ex: 299.90'],
                ['name' => 'fornecedor', 'label' => 'Fornecedor', 'type' => 'fk',
                 'fk_endpoint' => 'fornecedores', 'fk_id' => 'codfornecedor',
                 'fk_display' => 'nomefornecedor', 'required' => true],
            ],
        ],

        /* ------------------------------------------------------------------ */
        /* VENDAS                                                              */
        /* ------------------------------------------------------------------ */

        'clientes' => [
            'endpoint'     => 'clientes',
            'id_field'     => 'codcliente',
            'is_composite' => false,
            'label'        => 'Cliente',
            'label_plural' => 'Clientes',
            'columns' => [
                ['field' => 'codcliente',  'label' => 'ID'],
                ['field' => 'nomecliente', 'label' => 'Nome'],
                ['field' => 'sexo',   'subfield' => 'nomesexo',   'label' => 'Sexo'],
                ['field' => 'cidade', 'subfield' => 'nomecidade', 'label' => 'Cidade'],
            ],
            'fields' => [
                ['name' => 'nomecliente', 'label' => 'Nome do Cliente', 'type' => 'text',
                 'placeholder' => 'Ex: João Silva', 'required' => true,
                 'minlength' => 3, 'maxlength' => 120],
                ['name' => 'sexo', 'label' => 'Sexo', 'type' => 'fk',
                 'fk_endpoint' => 'sexos', 'fk_id' => 'codsexo', 'fk_display' => 'nomesexo',
                 'required' => true],
                ['name' => 'rua', 'label' => 'Rua', 'type' => 'fk',
                 'fk_endpoint' => 'ruas', 'fk_id' => 'codrua', 'fk_display' => 'nomerua',
                 'required' => true],
                ['name' => 'bairro', 'label' => 'Bairro', 'type' => 'fk',
                 'fk_endpoint' => 'bairros', 'fk_id' => 'codbairro', 'fk_display' => 'nomebairro',
                 'required' => true],
                ['name' => 'cep', 'label' => 'CEP', 'type' => 'fk',
                 'fk_endpoint' => 'ceps', 'fk_id' => 'codcep', 'fk_display' => 'numerocep',
                 'required' => true],
                ['name' => 'cidade', 'label' => 'Cidade', 'type' => 'fk',
                 'fk_endpoint' => 'cidades', 'fk_id' => 'codcidade', 'fk_display' => 'nomecidade',
                 'required' => true],
            ],
        ],

        'compras' => [
            'endpoint'     => 'compras',
            'id_field'     => 'codcompra',
            'is_composite' => false,
            'label'        => 'Compra',
            'label_plural' => 'Compras',
            'columns' => [
                ['field' => 'codcompra',  'label' => 'ID'],
                ['field' => 'datacompra', 'label' => 'Data'],
                ['field' => 'cliente', 'subfield' => 'nomecliente', 'label' => 'Cliente'],
            ],
            'fields' => [
                ['name' => 'datacompra', 'label' => 'Data da Compra', 'type' => 'date',
                 'required' => true],
                ['name' => 'cliente', 'label' => 'Cliente', 'type' => 'fk',
                 'fk_endpoint' => 'clientes', 'fk_id' => 'codcliente',
                 'fk_display' => 'nomecliente', 'required' => true],
            ],
        ],

        'compra-produtos' => [
            'endpoint'     => 'compra-produtos',
            'id_field'     => null,
            'is_composite' => true,
            'label'        => 'Item de Compra',
            'label_plural' => 'Itens de Compra',
            'columns' => [
                ['field' => 'id', 'subfield' => 'codcomprafk',  'label' => 'ID Compra'],
                ['field' => 'id', 'subfield' => 'codprodutofk', 'label' => 'ID Produto'],
                ['field' => 'compra',    'subfield' => 'datacompra',  'label' => 'Data Compra'],
                ['field' => 'produto',   'subfield' => 'nomeproduto', 'label' => 'Produto'],
                ['field' => 'quantidade','label' => 'Qtd'],
                ['field' => 'valorcp',   'label' => 'Valor (R$)'],
            ],
            'fields' => [
                ['name' => 'compra', 'label' => 'Compra', 'type' => 'fk',
                 'fk_endpoint' => 'compras', 'fk_id' => 'codcompra',
                 'fk_display' => 'datacompra', 'required' => true],
                ['name' => 'produto', 'label' => 'Produto', 'type' => 'fk',
                 'fk_endpoint' => 'produtos', 'fk_id' => 'codproduto',
                 'fk_display' => 'nomeproduto', 'required' => true],
                ['name' => 'quantidade', 'label' => 'Quantidade', 'type' => 'number',
                 'required' => true, 'min' => 1, 'placeholder' => 'Ex: 2'],
                ['name' => 'valorcp', 'label' => 'Valor Unitário (R$)', 'type' => 'decimal',
                 'required' => true, 'min' => '0.00', 'step' => '0.01',
                 'placeholder' => 'Ex: 29.90'],
            ],
        ],

    ];
}
