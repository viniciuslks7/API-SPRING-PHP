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
@Table(name = "sexo")
public class Sexo {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Column(name = "codsexo")
    private Integer codsexo;

    @NotBlank(message = "Nome do sexo e obrigatorio")
    @Size(min = 3, max = 20, message = "Nome do sexo deve ter entre 3 e 20 caracteres")
    @Column(name = "nomesexo", nullable = false, length = 20)
    private String nomesexo;

    public Integer getCodsexo() {
        return codsexo;
    }

    public void setCodsexo(Integer codsexo) {
        this.codsexo = codsexo;
    }

    public String getNomesexo() {
        return nomesexo;
    }

    public void setNomesexo(String nomesexo) {
        this.nomesexo = nomesexo;
    }
}
