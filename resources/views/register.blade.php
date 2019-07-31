@extends('layouts.app')
@section('content')
<section id="" class="container">
    <div class="row">
        <div class="container col " align="justify">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident dolore molestias deserunt, quidem recusandae laudantium ratione ad nisi natus, 
            soluta illum quasi illo iure commodi praesentium? Porro esse enim doloremque? Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit nam, 
            quibusdam incidunt laboriosam aut expedita iure magni necessitatibus saepe officiis eos delectus inventore minima vitae repudiandae tempore maiores 
            itaque libero!
        </div>
    </div>
</section>
<section id="register">
    <div class="row">
        <div class="col-lg-5">

        </div>
        <div class="col-lg-7 p-0">
            <div class="formrow row">
                <div class="col text-center">
                    <h4>Registrate</h4>
                </div>
            </div>
            <div class="row ml-5 mr-5 mt-4">
                <div class="formsuccess col">
                    <form action="" method="post" v-on:submit.prevent="register" >
                        @csrf
                        <div class="form-group">
                            <label  class="form-control-label" for="income">Nombre*</label>
                            <input type="text"  name="name"
                                :class="['form-control', (name.clase).trim() ? 'is-'+name.clase : '']"
                                type="text" 
                                v-model="name.input"
                                v-on:keyup="escribirLetras(name)"
                                ref='name' required id="name">
                            <div :class="(name.clase.trim() ? name.clase:'')+'-feedback'" v-text="name.mensaje"></div>
                        </div>
                        <div class="form-group">
                            <label  class="form-control-label" for="income">Entidad Financiera*</label>
                            <input type="text"  name="financial_entity"
                                :class="['form-control', (financial_entity.clase).trim() ? 'is-'+financial_entity.clase : '']"
                                type="text" 
                                v-model="financial_entity.input"
                                v-on:keyup="escribirLetras(financial_entity)"
                                ref='financial_entity' required id="financial_entity">
                            <div :class="(financial_entity.clase.trim() ? financial_entity.clase:'')+'-feedback'" v-text="financial_entity.mensaje"></div>
                        </div>
                        <div class="form-group">
                            <label  class="form-control-label" for="charge">Cargo*</label>
                            <input type="text"  name="charge"
                                :class="['form-control', (charge.clase).trim() ? 'is-'+charge.clase : '']"
                                type="text" 
                                v-model="charge.input"
                                v-on:keyup="escribirLetras(charge)"
                                ref='charge' required id="charge">
                            <div :class="(charge.clase.trim() ? charge.clase:'')+'-feedback'" v-text="charge.mensaje"></div>
                        </div>
                        <div class="form-group">
                            <label  class="form-control-label" for="email">Email*</label>
                            <input class ="form-control"type="email" v-model="email" name="email" required id="email">
                        </div>
                        <div class="form-group">
                            <label  class="form-control-label" for="phone">Telefono*</label>
                            <input type="text"  name="phone"
                                :class="['form-control', (phone.clase).trim() ? 'is-'+phone.clase : '']"
                                type="text" 
                                v-model="phone.input"
                                v-on:keyup="escribir(phone)"
                                ref='phone' required id="phone">
                            <div :class="(phone.clase.trim() ? phone.clase:'')+'-feedback'" v-text="phone.mensaje"></div>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                            <a href="{{asset('documents/terminos-y-condiciones.pdf')}}" target="_blank">Acepto términos y condiciones*</a>
                        </div>
                        <div class="text-center mb-3">  
                            <input type="submit" value="Registrar" class="btn btn-login">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection()
