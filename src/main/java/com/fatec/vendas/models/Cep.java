package com.fatec.vendas.models;

import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.Table;
import jakarta.validation.constraints.NotBlank;
import jakarta.validation.constraints.Pattern;

@Entity
@Table(name = "cep")
public class Cep {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Column(name = "codcep")
    private Integer codcep;

    @NotBlank(message = "Numero do CEP e obrigatorio")
    @Pattern(regexp = "^\\d{5}-?\\d{3}$", message = "CEP deve estar no formato 99999-999")
    @Column(name = "numerocep", nullable = false, length = 9)
    private String numerocep;

    public Integer getCodcep() {
        return codcep;
    }

    public void setCodcep(Integer codcep) {
        this.codcep = codcep;
    }

    public String getNumerocep() {
        return numerocep;
    }

    public void setNumerocep(String numerocep) {
        this.numerocep = numerocep;
    }
}
