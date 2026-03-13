package com.fatec.vendas.models;

import java.math.BigDecimal;

import jakarta.persistence.Column;
import jakarta.persistence.EmbeddedId;
import jakarta.persistence.Entity;
import jakarta.persistence.JoinColumn;
import jakarta.persistence.ManyToOne;
import jakarta.persistence.MapsId;
import jakarta.persistence.Table;
import jakarta.validation.constraints.DecimalMin;
import jakarta.validation.constraints.NotNull;
import jakarta.validation.constraints.Positive;

@Entity
@Table(name = "compraproduto")
public class CompraProduto {

    @EmbeddedId
    private CompraProdutoId id;

    @NotNull(message = "Compra e obrigatoria")
    @ManyToOne(optional = false)
    @MapsId("codcomprafk")
    @JoinColumn(name = "codcomprafk", nullable = false)
    private Compra compra;

    @NotNull(message = "Produto e obrigatorio")
    @ManyToOne(optional = false)
    @MapsId("codprodutofk")
    @JoinColumn(name = "codprodutofk", nullable = false)
    private Produto produto;

    @NotNull(message = "Quantidade e obrigatoria")
    @Positive(message = "Quantidade deve ser maior que zero")
    @Column(name = "quantidade", nullable = false)
    private Integer quantidade;

    @NotNull(message = "Valor e obrigatorio")
    @DecimalMin(value = "0.00", inclusive = true, message = "Valor nao pode ser negativo")
    @Column(name = "valorcp", nullable = false, precision = 12, scale = 2)
    private BigDecimal valorcp;

    public CompraProdutoId getId() {
        return id;
    }

    public void setId(CompraProdutoId id) {
        this.id = id;
    }

    public Compra getCompra() {
        return compra;
    }

    public void setCompra(Compra compra) {
        this.compra = compra;
    }

    public Produto getProduto() {
        return produto;
    }

    public void setProduto(Produto produto) {
        this.produto = produto;
    }

    public Integer getQuantidade() {
        return quantidade;
    }

    public void setQuantidade(Integer quantidade) {
        this.quantidade = quantidade;
    }

    public BigDecimal getValorcp() {
        return valorcp;
    }

    public void setValorcp(BigDecimal valorcp) {
        this.valorcp = valorcp;
    }
}
