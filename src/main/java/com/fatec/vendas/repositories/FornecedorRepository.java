package com.fatec.vendas.repositories;

import org.springframework.data.jpa.repository.JpaRepository;

import com.fatec.vendas.models.Fornecedor;
public interface FornecedorRepository extends JpaRepository<Fornecedor, Integer> {
}
