package com.fatec.vendas.repositories;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Modifying;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;

import com.fatec.vendas.models.CompraProduto;
import com.fatec.vendas.models.CompraProdutoId;

public interface CompraProdutoRepository extends JpaRepository<CompraProduto, CompraProdutoId> {

    @Modifying
    @Query("delete from CompraProduto cp where cp.produto.codproduto = :codproduto")
    int deleteByProdutoId(@Param("codproduto") Integer codproduto);
}
