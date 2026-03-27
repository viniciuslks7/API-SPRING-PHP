package com.fatec.vendas.controllers;

import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import com.fatec.vendas.models.Cep;
import com.fatec.vendas.services.CepService;

@RestController
@RequestMapping("/ceps")
public class CepController extends AbstractCrudController<Cep, Integer> {

    public CepController(CepService service) {
        super(service);
    }

    @Override
    protected void setId(Cep entity, Integer id) {
        entity.setCodcep(id);
    }
}
