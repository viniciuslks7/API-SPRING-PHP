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
@Table(name = "rua")
public class Rua {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Column(name = "codrua")
    private Integer codrua;

    @NotBlank(message = "Nome da rua e obrigatorio")
    @Size(min = 3, max = 120, message = "Nome da rua deve ter entre 3 e 120 caracteres")
    @Column(name = "nomerua", nullable = false, length = 120)
    private String nomerua;

    public Integer getCodrua() {
        return codrua;
    }

    public void setCodrua(Integer codrua) {
        this.codrua = codrua;
    }

    public String getNomerua() {
        return nomerua;
    }

    public void setNomerua(String nomerua) {
        this.nomerua = nomerua;
    }
}
