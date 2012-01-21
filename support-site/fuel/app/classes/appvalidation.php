<?php
class Appvalidation {
    public static function _validation_unique($val, $options) {
      Log::debug('Appvalidation _validation_unique');
      #Validation::active()->set_message('unique', 'The field :label must be unique, but :value has already been used');
      list($table, $field) = explode('.', $options);

      $result = DB::select("LOWER (\"$field\")")
        ->where($field, '=', Str::lower($val))
        ->from($table)->execute();

      return ! ($result->count() > 0);
    }
}
?>
