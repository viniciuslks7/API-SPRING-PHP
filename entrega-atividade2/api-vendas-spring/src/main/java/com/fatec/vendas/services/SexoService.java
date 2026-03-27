package com.fatec.vendas.services;

import org.springframework.stereotype.Service;
import com.fatec.vendas.models.Sexo;
import com.fatec.vendas.repositories.SexoRepository;

@Service
public class SexoService extends AbstractCrudService<Sexo, Integer> {
    public SexoService(SexoRepository repository) {
        super(repository);
    }
}
