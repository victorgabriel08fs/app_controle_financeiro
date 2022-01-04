@php
function formatCpf($value)
{
    $cpf = preg_replace('/\D/', '', $value);

    return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', "\$1.\$2.\$3-\$4", $cpf);
}
@endphp
