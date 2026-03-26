package com.fatec.vendas.services;

import java.util.List;
import java.util.Optional;

import org.springframework.stereotype.Service;

import com.fatec.vendas.models.CompraProduto;
import com.fatec.vendas.models.CompraProdutoId;
import com.fatec.vendas.repositories.CompraProdutoRepository;

@Service
public class CompraProdutoService {

    private final CompraProdutoRepository repository;

    public CompraProdutoService(CompraProdutoRepository repository) {
        this.repository = repository;
    }

    public List<CompraProduto> findAll() {
        return repository.findAll();
    }

    public Optional<CompraProduto> findById(CompraProdutoId id) {
        return repository.findById(id);
    }

    public CompraProduto save(CompraProduto entity) {
        return repository.save(entity);
    }

    public boolean existsById(CompraProdutoId id) {
        return repository.existsById(id);
    }

    public void deleteById(CompraProdutoId id) {
        repository.deleteById(id);
    }
}
