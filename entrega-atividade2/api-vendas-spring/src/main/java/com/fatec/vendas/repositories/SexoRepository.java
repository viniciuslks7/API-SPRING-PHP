package com.fatec.vendas.repositories;

import org.springframework.data.jpa.repository.JpaRepository;

import com.fatec.vendas.models.Sexo;
public interface SexoRepository extends JpaRepository<Sexo, Integer> {
}
