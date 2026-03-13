package com.fatec.vendas.controllers;

import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import com.fatec.vendas.models.Rua;
import com.fatec.vendas.repositories.RuaRepository;

@RestController
@RequestMapping("/ruas")
public class RuaController extends AbstractCrudController<Rua, Integer> {

    public RuaController(RuaRepository repository) {
        super(repository);
    }

    @Override
    protected void setId(Rua entity, Integer id) {
        entity.setCodrua(id);
    }
}
