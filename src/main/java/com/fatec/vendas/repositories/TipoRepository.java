package com.fatec.vendas.repositories;

import org.springframework.data.jpa.repository.JpaRepository;

import com.fatec.vendas.models.Tipo;
public interface TipoRepository extends JpaRepository<Tipo, Integer> {
}
