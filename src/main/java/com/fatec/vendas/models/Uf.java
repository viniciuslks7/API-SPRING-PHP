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
@Table(name = "uf")
public class Uf {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Column(name = "coduf")
    private Integer coduf;

    @NotBlank(message = "Nome da UF e obrigatorio")
    @Size(min = 2, max = 60, message = "Nome da UF deve ter entre 2 e 60 caracteres")
    @Column(name = "nomeuf", nullable = false, length = 60)
    private String nomeuf;

    @NotBlank(message = "Sigla da UF e obrigatoria")
    @Size(min = 2, max = 2, message = "Sigla da UF deve ter 2 caracteres")
    @Column(name = "siglauf", nullable = false, length = 2)
    private String siglauf;

    public Integer getCoduf() {
        return coduf;
    }

    public void setCoduf(Integer coduf) {
        this.coduf = coduf;
    }

    public String getNomeuf() {
        return nomeuf;
    }

    public void setNomeuf(String nomeuf) {
        this.nomeuf = nomeuf;
    }

    public String getSiglauf() {
        return siglauf;
    }

    public void setSiglauf(String siglauf) {
        this.siglauf = siglauf;
    }
}
