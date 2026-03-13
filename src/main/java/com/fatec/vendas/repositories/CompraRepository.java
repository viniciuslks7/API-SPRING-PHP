package com.fatec.vendas.repositories;

import org.springframework.data.jpa.repository.JpaRepository;

import com.fatec.vendas.models.Compra;
public interface CompraRepository extends JpaRepository<Compra, Integer> {
}
