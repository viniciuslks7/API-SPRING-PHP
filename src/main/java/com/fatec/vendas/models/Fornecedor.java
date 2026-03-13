package com.fatec.vendas.models;

import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.JoinColumn;
import jakarta.persistence.ManyToOne;
import jakarta.persistence.Table;
import jakarta.validation.constraints.Email;
import jakarta.validation.constraints.NotBlank;
import jakarta.validation.constraints.NotNull;
import jakarta.validation.constraints.Pattern;
import jakarta.validation.constraints.Size;

@Entity
@Table(name = "fornecedor")
public class Fornecedor {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Column(name = "codfornecedor")
    private Integer codfornecedor;

    @NotBlank(message = "Nome do fornecedor e obrigatorio")
    @Size(min = 3, max = 120, message = "Nome do fornecedor deve ter entre 3 e 120 caracteres")
    @Column(name = "nomefornecedor", nullable = false, length = 120)
    private String nomefornecedor;

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

    @NotBlank(message = "Telefone do fornecedor e obrigatorio")
    @Pattern(regexp = "^[0-9()+\\-\\s]{8,20}$", message = "Telefone invalido")
    @Column(name = "telefonefornecedor", nullable = false, length = 20)
    private String telefonefornecedor;

    @NotBlank(message = "Email do fornecedor e obrigatorio")
    @Email(message = "Email invalido")
    @Column(name = "emailfornecedor", nullable = false, length = 120)
    private String emailfornecedor;

    public Integer getCodfornecedor() {
        return codfornecedor;
    }

    public void setCodfornecedor(Integer codfornecedor) {
        this.codfornecedor = codfornecedor;
    }

    public String getNomefornecedor() {
        return nomefornecedor;
    }

    public void setNomefornecedor(String nomefornecedor) {
        this.nomefornecedor = nomefornecedor;
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

    public String getTelefonefornecedor() {
        return telefonefornecedor;
    }

    public void setTelefonefornecedor(String telefonefornecedor) {
        this.telefonefornecedor = telefonefornecedor;
    }

    public String getEmailfornecedor() {
        return emailfornecedor;
    }

    public void setEmailfornecedor(String emailfornecedor) {
        this.emailfornecedor = emailfornecedor;
    }
}
