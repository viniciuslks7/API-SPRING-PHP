package com.fatec.vendas.controllers;

import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import com.fatec.vendas.models.Uf;
import com.fatec.vendas.services.UfService;

@RestController
@RequestMapping("/ufs")
public class UfController extends AbstractCrudController<Uf, Integer> {

    public UfController(UfService service) {
        super(service);
    }

    @Override
    protected void setId(Uf entity, Integer id) {
        entity.setCoduf(id);
    }
}
