package com.fatec.vendas.controllers;

import java.util.List;

import org.springframework.dao.DataIntegrityViolationException;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import com.fatec.vendas.models.CompraProduto;
import com.fatec.vendas.models.CompraProdutoId;
import com.fatec.vendas.services.CompraProdutoService;

import jakarta.validation.Valid;

@RestController
@RequestMapping("/compra-produtos")
public class CompraProdutoController {

    private final CompraProdutoService service;

    public CompraProdutoController(CompraProdutoService service) {
        this.service = service;
    }

    @GetMapping
    public List<CompraProduto> findAll() {
        return service.findAll();
    }

    @GetMapping("/{codcompra}/{codproduto}")
    public ResponseEntity<CompraProduto> findById(
            @PathVariable Integer codcompra,
            @PathVariable Integer codproduto) {
        CompraProdutoId id = new CompraProdutoId(codcompra, codproduto);
        return service.findById(id)
                .map(ResponseEntity::ok)
                .orElseGet(() -> ResponseEntity.notFound().build());
    }

    @PostMapping
    public ResponseEntity<CompraProduto> create(@Valid @RequestBody CompraProduto entity) {
        if (entity.getId() == null && entity.getCompra() != null && entity.getProduto() != null) {
            entity.setId(new CompraProdutoId(entity.getCompra().getCodcompra(), entity.getProduto().getCodproduto()));
        }

        CompraProduto saved = service.save(entity);
        return ResponseEntity.status(HttpStatus.CREATED).body(saved);
    }

    @PutMapping("/{codcompra}/{codproduto}")
    public ResponseEntity<CompraProduto> update(
            @PathVariable Integer codcompra,
            @PathVariable Integer codproduto,
            @Valid @RequestBody CompraProduto entity) {

        CompraProdutoId id = new CompraProdutoId(codcompra, codproduto);
        if (!service.existsById(id)) {
            return ResponseEntity.notFound().build();
        }

        entity.setId(id);
        CompraProduto saved = service.save(entity);
        return ResponseEntity.ok(saved);
    }

    @DeleteMapping("/{codcompra}/{codproduto}")
    public ResponseEntity<Void> delete(
            @PathVariable Integer codcompra,
            @PathVariable Integer codproduto) {

        CompraProdutoId id = new CompraProdutoId(codcompra, codproduto);
        if (!service.existsById(id)) {
            return ResponseEntity.notFound().build();
        }

        try {
            service.deleteById(id);
            return ResponseEntity.noContent().build();
        } catch (DataIntegrityViolationException ex) {
            return ResponseEntity.status(HttpStatus.CONFLICT).build();
        }
    }
}
