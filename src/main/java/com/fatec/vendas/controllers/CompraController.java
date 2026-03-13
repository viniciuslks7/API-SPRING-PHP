package com.fatec.vendas.controllers;

import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import com.fatec.vendas.models.Compra;
import com.fatec.vendas.repositories.CompraRepository;

@RestController
@RequestMapping("/compras")
public class CompraController extends AbstractCrudController<Compra, Integer> {

    public CompraController(CompraRepository repository) {
        super(repository);
    }

    @Override
    protected void setId(Compra entity, Integer id) {
        entity.setCodcompra(id);
    }
}
