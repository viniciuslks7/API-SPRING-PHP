package com.fatec.vendas.services;

import org.springframework.stereotype.Service;
import com.fatec.vendas.models.Rua;
import com.fatec.vendas.repositories.RuaRepository;

@Service
public class RuaService extends AbstractCrudService<Rua, Integer> {
    public RuaService(RuaRepository repository) {
        super(repository);
    }
}
