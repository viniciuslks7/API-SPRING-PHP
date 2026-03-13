package com.fatec.vendas.controllers;

import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import com.fatec.vendas.models.Cep;
import com.fatec.vendas.repositories.CepRepository;

@RestController
@RequestMapping("/ceps")
public class CepController extends AbstractCrudController<Cep, Integer> {

    public CepController(CepRepository repository) {
        super(repository);
    }

    @Override
    protected void setId(Cep entity, Integer id) {
        entity.setCodcep(id);
    }
}
