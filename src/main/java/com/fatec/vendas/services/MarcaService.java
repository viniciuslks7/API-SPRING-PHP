package com.fatec.vendas.services;

import org.springframework.stereotype.Service;
import com.fatec.vendas.models.Marca;
import com.fatec.vendas.repositories.MarcaRepository;

@Service
public class MarcaService extends AbstractCrudService<Marca, Integer> {
    public MarcaService(MarcaRepository repository) {
        super(repository);
    }
}
