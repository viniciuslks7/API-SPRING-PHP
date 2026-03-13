package com.fatec.vendas.controllers;

import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import com.fatec.vendas.models.Bairro;
import com.fatec.vendas.repositories.BairroRepository;

@RestController
@RequestMapping("/bairros")
public class BairroController extends AbstractCrudController<Bairro, Integer> {

    public BairroController(BairroRepository repository) {
        super(repository);
    }

    @Override
    protected void setId(Bairro entity, Integer id) {
        entity.setCodbairro(id);
    }
}
