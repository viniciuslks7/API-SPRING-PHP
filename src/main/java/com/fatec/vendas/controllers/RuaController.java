package com.fatec.vendas.controllers;

import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import com.fatec.vendas.models.Rua;
import com.fatec.vendas.services.RuaService;

@RestController
@RequestMapping("/ruas")
public class RuaController extends AbstractCrudController<Rua, Integer> {

    public RuaController(RuaService service) {
        super(service);
    }

    @Override
    protected void setId(Rua entity, Integer id) {
        entity.setCodrua(id);
    }
}
