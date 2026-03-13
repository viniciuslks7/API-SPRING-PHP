package com.fatec.vendas.controllers;

import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import com.fatec.vendas.models.Cidade;
import com.fatec.vendas.repositories.CidadeRepository;

@RestController
@RequestMapping("/cidades")
public class CidadeController extends AbstractCrudController<Cidade, Integer> {

    public CidadeController(CidadeRepository repository) {
        super(repository);
    }

    @Override
    protected void setId(Cidade entity, Integer id) {
        entity.setCodcidade(id);
    }
}
