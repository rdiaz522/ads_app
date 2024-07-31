export interface UserFormData {
    id: string;
    firstname: string;
    middlename: string;
    lastname: string;
    username: string;
    email: string;
    subdomain_id: string;
    user_type: UserType;
    gender: Gender;
    login_status: LoginStatus
    email_verified_at: Date;
    password: string;
    remember_token: string;
    created_at: Date;
    updated_at: Date;
    created_by: string;
    updated_by: string;
    deleted_at: Date;
    deleted_by: string;
}

export enum UserType {
    Administrator = 'ADMINISTRATOR',
    User = 'USER'
}

export enum Gender {
    Male = 'male',
    Female = 'female'
}

export enum LoginStatus {
    Active = 'Active',
    Inactive = 'Inactive'
}




