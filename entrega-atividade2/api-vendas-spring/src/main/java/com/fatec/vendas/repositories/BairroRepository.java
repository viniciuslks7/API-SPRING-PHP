package com.fatec.vendas.repositories;

import org.springframework.data.jpa.repository.JpaRepository;

import com.fatec.vendas.models.Bairro;
public interface BairroRepository extends JpaRepository<Bairro, Integer> {
}
