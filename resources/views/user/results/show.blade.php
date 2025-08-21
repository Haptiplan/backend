<x-app-layout>
    <!-- Dashboard Header -->
    <x-dashboard-header>
        {{ __('Dashboard') }}
    </x-dashboard-header>

    <!-- Layout Content Box -->
    <x-content-box>
        <!-- Centered Title with Elegant Font and Smooth Transition -->
        <x-page-title>
            {{ __('messages.results') }}
        </x-page-title>

        <!-- List of Decisions -->
        <div class="mt-8">
            <!-- Layout Content Box -->
            <x-content-box>

                <!-- Centered Title with Elegant Font and Smooth Transition -->
                <x-page-title>
                    {{ __('messages.guv') }}
                </x-page-title>

                <!-- Company List Grouped by Game with Stylish List Items -->
                <div class="mt-8 space-y-8">
                    <div class="space-y-4">
                        <table class="table-fixed w-full border">
                            <thead>
                                <tr>
                                    <th class="text-left font-bold border pb-2">Aufwendungen</th>
                                    <th class="text-left font-bold border-b pb-2">Erträge</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $maxRows = max(count($guv['aufwendungen']), count($guv['ertraege']));
                                @endphp
                                @for($i = 0; $i < $maxRows; $i++)
                                    <tr>
                                    <td class="border-r pr-4 align-top">
                                        @if(isset($guv['aufwendungen'][$i]))
                                        {{ $guv['aufwendungen'][$i]['konto'] }}: {{ number_format($guv['aufwendungen'][$i]['saldo'], 2, ',', '.') }} €
                                        @endif
                                    </td>
                                    <td class="pl-4 align-top">
                                        @if(isset($guv['ertraege'][$i]))
                                        {{ $guv['ertraege'][$i]['konto'] }}: {{ number_format($guv['ertraege'][$i]['saldo'], 2, ',', '.') }} €
                                        @endif
                                    </td>
                                    </tr>
                                    @endfor
                                    <tr class="font-semibold border-t">
                                        <td class="border-r pr-4 pt-2">
                                            Summe Aufwendungen: {{ number_format($guv['aufwendungen_sum'], 2, ',', '.') }} €
                                        </td>
                                        <td class="pl-4 pt-2">
                                            Summe Erträge: {{ number_format($guv['ertraege_sum'], 2, ',', '.') }} €
                                        </td>
                                    </tr>

                            </tbody>
                        </table>
                        Ergebnis: {{ number_format($guv['ergebnis'], 2, ',', '.') }} €
                    </div>
                </div>

            </x-content-box>
        </div>
        <!-- List of Decisions -->
        <div class="mt-8">
            <!-- Layout Content Box -->
            <x-content-box>

                <!-- Centered Title with Elegant Font and Smooth Transition -->
                <x-page-title>
                    {{ __('messages.bilanz') }}
                </x-page-title>

                <!-- Company List Grouped by Game with Stylish List Items -->
                <div class="mt-8 space-y-8">
                    <div class="space-y-4">
                        <table class="w-full border mt-4">
                            <thead>
                                <tr>
                                    <th class="text-left font-bold border pb-2">Aktiv</th>
                                    <th class="text-left font-bold border-b pb-2">Passiv</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- AV & EK -->
                                <tr>
                                    <td class="border font-bold pt-4">Anlagevermögen (AV)</td>
                                    <td class="border font-bold pt-4">Eigenkapital (EK)</td>
                                </tr>
                                @php
                                    $maxRowsAV_EK = max(count($bilanz['aktiva']['av']), count($bilanz['passiva']['ek']));
                                @endphp
                                @for($i = 0; $i < $maxRowsAV_EK; $i++)
                                    <tr>
                                        <td class="border-r pr-4 align-top">
                                            @if(isset($bilanz['aktiva']['av'][$i]))
                                                {{ $bilanz['aktiva']['av'][$i]['konto'] }}: {{ number_format($bilanz['aktiva']['av'][$i]['saldo'], 2, ',', '.') }} €
                                            @endif
                                        </td>
                                        <td class="pl-4 align-top">
                                            @if(isset($bilanz['passiva']['ek'][$i]))
                                                {{ $bilanz['passiva']['ek'][$i]['konto'] }}: {{ number_format($bilanz['passiva']['ek'][$i]['saldo'], 2, ',', '.') }} €
                                            @endif
                                        </td>
                                    </tr>
                                @endfor
                                <tr class="font-semibold border-t">
                                    <td class="border pr-4 pt-2">
                                        Summe AV: {{ number_format($bilanz['aktiva']['av_sum'], 2, ',', '.') }} €
                                    </td>
                                    <td class="border pl-4 pt-2">
                                        Summe EK: {{ number_format($bilanz['passiva']['ek_sum'], 2, ',', '.') }} €
                                    </td>
                                </tr>
                                <!-- UV & FK -->
                                <tr>
                                    <td class="border font-bold pt-4">Umlaufvermögen (UV)</td>
                                    <td class="border font-bold pt-4">Fremdkapital (FK)</td>
                                </tr>
                                @php
                                    $maxRowsUV_FK = max(count($bilanz['aktiva']['uv']), count($bilanz['passiva']['fk']));
                                @endphp
                                @for($i = 0; $i < $maxRowsUV_FK; $i++)
                                    <tr>
                                        <td class="border-r pr-4 align-top">
                                            @if(isset($bilanz['aktiva']['uv'][$i]))
                                                {{ $bilanz['aktiva']['uv'][$i]['konto'] }}: {{ number_format($bilanz['aktiva']['uv'][$i]['saldo'], 2, ',', '.') }} €
                                            @endif
                                        </td>
                                        <td class="pl-4 align-top">
                                            @if(isset($bilanz['passiva']['fk'][$i]))
                                                {{ $bilanz['passiva']['fk'][$i]['konto'] }}: {{ number_format($bilanz['passiva']['fk'][$i]['saldo'], 2, ',', '.') }} €
                                            @endif
                                        </td>
                                    </tr>
                                @endfor
                                <tr class="font-semibold border-t">
                                    <td class="border-r pr-4 pt-2">
                                        Summe UV: {{ number_format($bilanz['aktiva']['uv_sum'], 2, ',', '.') }} €
                                    </td>
                                    <td class="pl-4 pt-2">
                                        Summe FK: {{ number_format($bilanz['passiva']['fk_sum'], 2, ',', '.') }} €
                                    </td>
                                </tr>
                                <!-- Gesamtsummen -->
                                <tr class="font-bold border-t">
                                    <td class="border-r pr-4 pt-4">
                                        Aktiva gesamt: {{ number_format($bilanz['activa_sum'], 2, ',', '.') }} €
                                    </td>
                                    <td class="pl-4 pt-4">
                                        Passiva gesamt: {{ number_format($bilanz['passiva_sum'], 2, ',', '.') }} €
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </x-content-box>
        </div>
    </x-content-box>
</x-app-layout>