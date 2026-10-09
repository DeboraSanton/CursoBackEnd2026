## LISTA DE EXERCÍCIOS DE FIXAÇÃO E PRÁTICA - SESSÕES, COOKIES e AUTENTICAÇÃO DE USUÁRIOS.

###  Exercícios Teóricos de Fixação

1. **Protocolo Stateless: O que significa afirmar que o protocolo HTTP é "stateless" e por que o mecanismo de cookies/sessões é necessário para aplicações modernas?**

**Resposta:**
O HTTP não guarda dados do usuário entre requisições. Cookies e sessões são necessários para manter o estado da navegação, como o login ativo

---

2. **Cookies vs. Sessões: Qual é a diferença entre os dados armazenados em um cookie e os dados mantidos no array superglobal $_SESSION? Qual dos dois apresenta maior segurança para informações confidenciais?**

**Resposta:**
Cookies ficam armazenados no navegador do cliente, enquanto a `$_SESSION` fica no servidor. A `$_SESSION` é mais segura para dados confidenciais porque o usuário não pode visualizar ou alterar esses dados no servidor.

---

3. **A Flag HttpOnly: Explique detalhadamente como a configuração httponly => true impede o sequestro de sessão (Session Hijacking) mesmo se a aplicação possuir uma vulnerabilidade de Cross-Site Scripting (XSS).**

**Resposta:**
Impede que scripts JavaScript leiam o cookie via `document.cookie`. Em uma vulnerabilidade XSS, o atacante consegue rodar código malicioso na página, mas não consegue capturar o cookie de sessão para realizar o Session Hijacking.

---

4. **A Flag SameSite: Qual é a finalidade do atributo SameSite=Lax em cookies e contra qual tipo de ataque corporativo ele atua?**

**Resposta:**
O atributo `SameSite=Lax` impede o envio automático de cookies em requisições feitas por outros sites, protegendo diretamente contra ataques de CSRF (Cross-Site Request Forgery).

---
5. **Ataque de Fixação de Sessão: O que é o ataque de Session Fixation e por que é mandatório executar session_regenerate_id(true) imediatamente após o login do usuário?**

**Resposta:**
Ocorre quando um atacante força a vítima a usar um ID de sessão conhecido antes do login. É mandatório usar `session_regenerate_id(true)` no login para trocar o ID por um novo e apagar o anterior, invalidando o acesso do atacante.

---

6. **MD5 e Rainbow Tables: Por que é considerado negligência técnica armazenar senhas com algoritmos rápidos como MD5 ou SHA256? Como as Rainbow Tables operam contra esses hashes?**

**Resposta:**
MD5 e SHA256 são rápidos demais, permitindo bilhões de tentativas por segundo. As Rainbow Tables são tabelas pré-computadas que associam senhas conhecidas a seus hashes, revelando a senha em segundos.

---

7. **O Papel do Salt: O que é o Salt criptográfico e por que ele garante que dois usuários com a mesma senha possuam hashes completamente distintos no banco de dados?**

**Resposta:**
É uma string aleatória adicionada à senha antes de gerar o hash. Garante que senhas iguais gerem hashes totalmente diferentes no banco de dados e inviabiliza as Rainbow Tables.

---

8. **Argon2id vs Bcrypt: Por que o algoritmo Argon2id é considerado superior ao Bcrypt na proteção contra ataques de força bruta realizados por placas de vídeo (GPUs) e circuitos ASIC?**

**Resposta:**
O Argon2id é superior por ser memory-hard, exigindo bastante memória RAM para calcular o hash. Isso inviabiliza ataques de força bruta via GPUs e ASICs, que têm pouca memória por núcleo.

---

9. **Timing Attacks: Por que a verificação de senhas deve ser feita com password_verify() em vez do operador de comparação comum ===?**

**Resposta:**
O operador === para a comparação no primeiro caractere diferente, gerando variações no tempo de resposta (timing attack). A função password_verify() realiza comparações em tempo constante, impedindo essa medição.






