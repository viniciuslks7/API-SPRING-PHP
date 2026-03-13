package com.fatec.vendas.models;

import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.Table;
import jakarta.validation.constraints.NotBlank;
import jakarta.validation.constraints.Size;

@Entity
@Table(name = "bairro")
public class Bairro {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Column(name = "codbairro")
    private Integer codbairro;

    @NotBlank(message = "Nome do bairro e obrigatorio")
    @Size(min = 2, max = 120, message = "Nome do bairro deve ter entre 2 e 120 caracteres")
    @Column(name = "nomebairro", nullable = false, length = 120)
    private String nomebairro;

    public Integer getCodbairro() {
        return codbairro;
    }

    public void setCodbairro(Integer codbairro) {
        this.codbairro = codbairro;
    }

    public String getNomebairro() {
        return nomebairro;
    }

    public void setNomebairro(String nomebairro) {
        this.nomebairro = nomebairro;
    }
}
