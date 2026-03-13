package com.fatec.vendas.controllers;

import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import com.fatec.vendas.models.Tipo;
import com.fatec.vendas.repositories.TipoRepository;

@RestController
@RequestMapping("/tipos")
public class TipoController extends AbstractCrudController<Tipo, Integer> {

    public TipoController(TipoRepository repository) {
        super(repository);
    }

    @Override
    protected void setId(Tipo entity, Integer id) {
        entity.setCodtipo(id);
    }
}
