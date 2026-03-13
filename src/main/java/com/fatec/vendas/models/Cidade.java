package com.fatec.vendas.models;

import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.JoinColumn;
import jakarta.persistence.ManyToOne;
import jakarta.persistence.Table;
import jakarta.validation.constraints.NotBlank;
import jakarta.validation.constraints.NotNull;
import jakarta.validation.constraints.Size;

@Entity
@Table(name = "cidade")
public class Cidade {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Column(name = "codcidade")
    private Integer codcidade;

    @NotBlank(message = "Nome da cidade e obrigatorio")
    @Size(min = 2, max = 120, message = "Nome da cidade deve ter entre 2 e 120 caracteres")
    @Column(name = "nomecidade", nullable = false, length = 120)
    private String nomecidade;

    @NotNull(message = "UF e obrigatoria")
    @ManyToOne(optional = false)
    @JoinColumn(name = "coduffk", nullable = false)
    private Uf uf;

    public Integer getCodcidade() {
        return codcidade;
    }

    public void setCodcidade(Integer codcidade) {
        this.codcidade = codcidade;
    }

    public String getNomecidade() {
        return nomecidade;
    }

    public void setNomecidade(String nomecidade) {
        this.nomecidade = nomecidade;
    }

    public Uf getUf() {
        return uf;
    }

    public void setUf(Uf uf) {
        this.uf = uf;
    }
}
