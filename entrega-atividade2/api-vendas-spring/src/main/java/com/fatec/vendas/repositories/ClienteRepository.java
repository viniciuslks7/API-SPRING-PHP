package com.fatec.vendas.repositories;

import org.springframework.data.jpa.repository.JpaRepository;

import com.fatec.vendas.models.Cliente;
public interface ClienteRepository extends JpaRepository<Cliente, Integer> {
}
