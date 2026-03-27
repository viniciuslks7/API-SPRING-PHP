package com.fatec.vendas.controllers;

import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import com.fatec.vendas.models.Sexo;
import com.fatec.vendas.services.SexoService;

@RestController
@RequestMapping("/sexos")
public class SexoController extends AbstractCrudController<Sexo, Integer> {

    public SexoController(SexoService service) {
        super(service);
    }

    @Override
    protected void setId(Sexo entity, Integer id) {
        entity.setCodsexo(id);
    }
}
