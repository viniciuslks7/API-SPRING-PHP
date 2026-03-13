package com.fatec.vendas.repositories;

import org.springframework.data.jpa.repository.JpaRepository;

import com.fatec.vendas.models.Produto;
public interface ProdutoRepository extends JpaRepository<Produto, Integer> {
}
