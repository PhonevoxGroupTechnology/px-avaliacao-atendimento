# Phonevox: Módulo de avaliação de atendimento (px-avaliacao-atendimento)

**pt-BR**: Instalador do módulo de avaliação da Phonevox para o Issabel4.<br>
**en-US**: Phonevox's User Rating module installer for Issabel4.

# Descrição

Script instalador para o módulo de avaliação da Phonevox, denominado *voxura* para o Issabel4.<br>
**NOTA**: *O módulo de avaliação utiliza um pacote depreciado do Issabel, "issabel-callcenter", que só funciona com Asterisk 11. [Clique aqui para saber mais](https://forum.issabel.org/d/4517-problemas-con-callcenter-y-asterisk-16/2).*

# Instalação

```sh
git clone https://github.com/adriankubinyete/px-avaliacao-atendimento.git
cd px-avaliacao-atendimento
chmod +x install.sh
./install.sh --help
```
**NOTA**: *O instalador precisa ser executado como root.*<br>

# Uso

Execute `./install.sh --help` para obter instruções detalhadas de como utilizar o instalador.

Exemplos de uso:
```
./install.sh -s="SUA_SENHA_DO_DATABASE" [--com-login|--sem-login] [--force-fix-php-timezone]
./install.sh -s="123456" --sem-login --force-fix-php-timezone
./install.sh -s="11111abc" --com-login
```
**NOTA**: *"--com-login" e "--sem-login" refere-se à se seus colaboradores realizam login no módulo callcenter. Caso loguem **como agente**, utilize "--com-login". Caso utilizem **login callback ou não logue**, utilize "--sem-login".*

