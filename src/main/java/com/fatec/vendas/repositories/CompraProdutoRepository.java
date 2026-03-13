package com.fatec.vendas.repositories;

import org.springframework.data.jpa.repository.JpaRepository;

import com.fatec.vendas.models.CompraProduto;
import com.fatec.vendas.models.CompraProdutoId;

public interface CompraProdutoRepository extends JpaRepository<CompraProduto, CompraProdutoId> {
}
