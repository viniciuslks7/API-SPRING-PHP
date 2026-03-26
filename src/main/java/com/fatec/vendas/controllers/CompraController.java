package com.fatec.vendas.controllers;

import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import com.fatec.vendas.models.Compra;
import com.fatec.vendas.services.CompraService;

@RestController
@RequestMapping("/compras")
public class CompraController extends AbstractCrudController<Compra, Integer> {

    public CompraController(CompraService service) {
        super(service);
    }

    @Override
    protected void setId(Compra entity, Integer id) {
        entity.setCodcompra(id);
    }
}
