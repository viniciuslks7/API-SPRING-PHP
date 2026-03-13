package com.fatec.vendas.repositories;

import org.springframework.data.jpa.repository.JpaRepository;

import com.fatec.vendas.models.Uf;
public interface UfRepository extends JpaRepository<Uf, Integer> {
}
