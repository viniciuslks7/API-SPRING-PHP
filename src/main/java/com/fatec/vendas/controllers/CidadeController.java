package com.fatec.vendas.controllers;

import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import com.fatec.vendas.models.Cidade;
import com.fatec.vendas.services.CidadeService;

@RestController
@RequestMapping("/cidades")
public class CidadeController extends AbstractCrudController<Cidade, Integer> {

    public CidadeController(CidadeService service) {
        super(service);
    }

    @Override
    protected void setId(Cidade entity, Integer id) {
        entity.setCodcidade(id);
    }
}
