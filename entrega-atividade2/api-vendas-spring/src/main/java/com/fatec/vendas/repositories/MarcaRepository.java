package com.fatec.vendas.repositories;

import org.springframework.data.jpa.repository.JpaRepository;

import com.fatec.vendas.models.Marca;
public interface MarcaRepository extends JpaRepository<Marca, Integer> {
}
