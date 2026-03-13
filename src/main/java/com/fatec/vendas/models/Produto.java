package com.fatec.vendas.models;

import java.math.BigDecimal;

import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.JoinColumn;
import jakarta.persistence.ManyToOne;
import jakarta.persistence.Table;
import jakarta.validation.constraints.DecimalMin;
import jakarta.validation.constraints.NotBlank;
import jakarta.validation.constraints.NotNull;
import jakarta.validation.constraints.PositiveOrZero;
import jakarta.validation.constraints.Size;

@Entity
@Table(name = "produto")
public class Produto {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Column(name = "codproduto")
    private Integer codproduto;

    @NotBlank(message = "Nome do produto e obrigatorio")
    @Size(min = 2, max = 120, message = "Nome do produto deve ter entre 2 e 120 caracteres")
    @Column(name = "nomeproduto", nullable = false, length = 120)
    private String nomeproduto;

    @NotNull(message = "Tipo e obrigatorio")
    @ManyToOne(optional = false)
    @JoinColumn(name = "codtipofk", nullable = false)
    private Tipo tipo;

    @NotNull(message = "Marca e obrigatoria")
    @ManyToOne(optional = false)
    @JoinColumn(name = "codmarcafk", nullable = false)
    private Marca marca;

    @NotNull(message = "Quantidade e obrigatoria")
    @PositiveOrZero(message = "Quantidade nao pode ser negativa")
    @Column(name = "quantidade", nullable = false)
    private Integer quantidade;

    @NotNull(message = "Valor e obrigatorio")
    @DecimalMin(value = "0.00", inclusive = true, message = "Valor nao pode ser negativo")
    @Column(name = "valor", nullable = false, precision = 12, scale = 2)
    private BigDecimal valor;

    @NotNull(message = "Fornecedor e obrigatorio")
    @ManyToOne(optional = false)
    @JoinColumn(name = "codfornecedorfk", nullable = false)
    private Fornecedor fornecedor;

    public Integer getCodproduto() {
        return codproduto;
    }

    public void setCodproduto(Integer codproduto) {
        this.codproduto = codproduto;
    }

    public String getNomeproduto() {
        return nomeproduto;
    }

    public void setNomeproduto(String nomeproduto) {
        this.nomeproduto = nomeproduto;
    }

    public Tipo getTipo() {
        return tipo;
    }

    public void setTipo(Tipo tipo) {
        this.tipo = tipo;
    }

    public Marca getMarca() {
        return marca;
    }

    public void setMarca(Marca marca) {
        this.marca = marca;
    }

    public Integer getQuantidade() {
        return quantidade;
    }

    public void setQuantidade(Integer quantidade) {
        this.quantidade = quantidade;
    }

    public BigDecimal getValor() {
        return valor;
    }

    public void setValor(BigDecimal valor) {
        this.valor = valor;
    }

    public Fornecedor getFornecedor() {
        return fornecedor;
    }

    public void setFornecedor(Fornecedor fornecedor) {
        this.fornecedor = fornecedor;
    }
}
