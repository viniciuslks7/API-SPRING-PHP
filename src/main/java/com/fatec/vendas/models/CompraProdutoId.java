package com.fatec.vendas.models;

import java.io.Serializable;
import java.util.Objects;

import jakarta.persistence.Column;
import jakarta.persistence.Embeddable;

@Embeddable
public class CompraProdutoId implements Serializable {

    @Column(name = "codcomprafk")
    private Integer codcomprafk;

    @Column(name = "codprodutofk")
    private Integer codprodutofk;

    public CompraProdutoId() {
    }

    public CompraProdutoId(Integer codcomprafk, Integer codprodutofk) {
        this.codcomprafk = codcomprafk;
        this.codprodutofk = codprodutofk;
    }

    public Integer getCodcomprafk() {
        return codcomprafk;
    }

    public void setCodcomprafk(Integer codcomprafk) {
        this.codcomprafk = codcomprafk;
    }

    public Integer getCodprodutofk() {
        return codprodutofk;
    }

    public void setCodprodutofk(Integer codprodutofk) {
        this.codprodutofk = codprodutofk;
    }

    @Override
    public boolean equals(Object o) {
        if (this == o) {
            return true;
        }
        if (!(o instanceof CompraProdutoId that)) {
            return false;
        }
        return Objects.equals(codcomprafk, that.codcomprafk)
                && Objects.equals(codprodutofk, that.codprodutofk);
    }

    @Override
    public int hashCode() {
        return Objects.hash(codcomprafk, codprodutofk);
    }
}
