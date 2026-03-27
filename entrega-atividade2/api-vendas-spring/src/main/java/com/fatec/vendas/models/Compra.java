package com.fatec.vendas.models;

import java.time.LocalDate;

import com.fasterxml.jackson.annotation.JsonFormat;

import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.JoinColumn;
import jakarta.persistence.ManyToOne;
import jakarta.persistence.Table;
import jakarta.validation.constraints.NotNull;

@Entity
@Table(name = "compra")
public class Compra {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Column(name = "codcompra")
    private Integer codcompra;

    @NotNull(message = "Data da compra e obrigatoria")
    @JsonFormat(pattern = "yyyy-MM-dd")
    @Column(name = "datacompra", nullable = false)
    private LocalDate datacompra;

    @NotNull(message = "Cliente e obrigatorio")
    @ManyToOne(optional = false)
    @JoinColumn(name = "codclientefk", nullable = false)
    private Cliente cliente;

    public Integer getCodcompra() {
        return codcompra;
    }

    public void setCodcompra(Integer codcompra) {
        this.codcompra = codcompra;
    }

    public LocalDate getDatacompra() {
        return datacompra;
    }

    public void setDatacompra(LocalDate datacompra) {
        this.datacompra = datacompra;
    }

    public Cliente getCliente() {
        return cliente;
    }

    public void setCliente(Cliente cliente) {
        this.cliente = cliente;
    }
}
