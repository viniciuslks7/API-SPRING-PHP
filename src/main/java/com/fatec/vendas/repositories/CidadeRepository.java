package com.fatec.vendas.repositories;

import org.springframework.data.jpa.repository.JpaRepository;

import com.fatec.vendas.models.Cidade;
public interface CidadeRepository extends JpaRepository<Cidade, Integer> {
}
