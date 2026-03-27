package com.fatec.vendas.services;

import org.springframework.stereotype.Service;
import com.fatec.vendas.models.Tipo;
import com.fatec.vendas.repositories.TipoRepository;

@Service
public class TipoService extends AbstractCrudService<Tipo, Integer> {
    public TipoService(TipoRepository repository) {
        super(repository);
    }
}
