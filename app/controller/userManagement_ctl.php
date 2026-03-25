<?

class UserManagementController extends CRUDController
{
    protected function getPostValueErrors($action, $values): array|bool {throw new Exception("Not implemented yet");}
    protected function loadSqlParams(string $action, array $values): array {throw new Exception("Not implemented yet");}
    protected function handdleSqlErrors(string $errorMessage, string $action, array $values): string {throw new Exception("Not implemented yet");}
    protected function callView(array $view, array $postValues): void {throw new Exception("Not implemented yet");}
    protected function completeViewInformations(): array {throw new Exception("Not implemented yet");}
    protected function create(array $valuesToAdd): bool {throw new Exception("Not implemented yet");}
    protected function update(array $valuesToModify): bool {throw new Exception("Not implemented yet");}
    protected function delete(): bool{throw new Exception("Not implemented yet");}
    protected function getSuccessMessage(string $action): string {throw new Exception("Not implemented yet");}
}
