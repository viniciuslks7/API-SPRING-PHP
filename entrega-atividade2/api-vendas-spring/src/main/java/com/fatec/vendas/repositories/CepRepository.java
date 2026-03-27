package com.fatec.vendas.repositories;

import org.springframework.data.jpa.repository.JpaRepository;

import com.fatec.vendas.models.Cep;
public interface CepRepository extends JpaRepository<Cep, Integer> {
}
