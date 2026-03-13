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
@Table(name = "cliente")
public class Cliente {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Column(name = "codcliente")
    private Integer codcliente;

    @NotBlank(message = "Nome do cliente e obrigatorio")
    @Size(min = 3, max = 120, message = "Nome do cliente deve ter entre 3 e 120 caracteres")
    @Column(name = "nomecliente", nullable = false, length = 120)
    private String nomecliente;

    @NotNull(message = "Sexo e obrigatorio")
    @ManyToOne(optional = false)
    @JoinColumn(name = "codsexofk", nullable = false)
    private Sexo sexo;

    @NotNull(message = "Rua e obrigatoria")
    @ManyToOne(optional = false)
    @JoinColumn(name = "codruafk", nullable = false)
    private Rua rua;

    @NotNull(message = "Bairro e obrigatorio")
    @ManyToOne(optional = false)
    @JoinColumn(name = "codbairrofk", nullable = false)
    private Bairro bairro;

    @NotNull(message = "CEP e obrigatorio")
    @ManyToOne(optional = false)
    @JoinColumn(name = "codcepfk", nullable = false)
    private Cep cep;

    @NotNull(message = "Cidade e obrigatoria")
    @ManyToOne(optional = false)
    @JoinColumn(name = "codcidadefk", nullable = false)
    private Cidade cidade;

    public Integer getCodcliente() {
        return codcliente;
    }

    public void setCodcliente(Integer codcliente) {
        this.codcliente = codcliente;
    }

    public String getNomecliente() {
        return nomecliente;
    }

    public void setNomecliente(String nomecliente) {
        this.nomecliente = nomecliente;
    }

    public Sexo getSexo() {
        return sexo;
    }

    public void setSexo(Sexo sexo) {
        this.sexo = sexo;
    }

    public Rua getRua() {
        return rua;
    }

    public void setRua(Rua rua) {
        this.rua = rua;
    }

    public Bairro getBairro() {
        return bairro;
    }

    public void setBairro(Bairro bairro) {
        this.bairro = bairro;
    }

    public Cep getCep() {
        return cep;
    }

    public void setCep(Cep cep) {
        this.cep = cep;
    }

    public Cidade getCidade() {
        return cidade;
    }

    public void setCidade(Cidade cidade) {
        this.cidade = cidade;
    }
}
